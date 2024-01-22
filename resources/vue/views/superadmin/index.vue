<template>
  <div>
    <h1>Admins</h1>
    <button type="button" @click="userForm(null)">Add</button>
  </div>

  <DataTable ref="table" class="display" :data="data" :columns="columns" />
</template>

<script setup>
    import { onMounted, ref } from 'vue';
    import userService from '../../services/userService';
    import DataTable from 'datatables.net-vue3';
    import DataTablesCore from 'datatables.net';
    import Swal from 'sweetalert2'
    
    DataTable.use(DataTablesCore)
    let dt
    const table = ref() // This variable is used in the `ref` attribute for the component
    const columns = [
        { data: 'id', title: 'Id' },
        { data: 'name', title: 'Name' },
        { data: 'email', title: 'Email' },
        { 
            data: 'roles',
            title: 'Role',
            render: function ( data, type, row ) {
                const rolesNames = data.map(role => role.name)
                return rolesNames.join(', ')
            },
        },
        {
            data: null,
            className: 'dt-center editor-edit',
            defaultContent: '<button type="button"><i class="fa fa-pencil"/></button>',
            orderable: false
        },
        {
            data: null,
            className: 'dt-center editor-delete',
            defaultContent: '<button type="button"><i class="fa fa-trash"/></button>',
            orderable: false
        }
    ];
    const data = ref([])
    userService.index().then(users => data.value = users)

    onMounted(function () {
        dt = table.value.dt;

        // Edit record
        dt.on('click', 'td.editor-edit', function (e) {
            e.preventDefault();
            const row = this.closest('tr');
            const rowData = dt.row(row).data();
            userForm(rowData)
        });

        // Delete a record
        dt.on('click', 'td.editor-delete', async function (e) {
            e.preventDefault();
            const row = this.closest('tr');
            const rowData = dt.row(row).data();
            const targetId = rowData.id
            
            const { value } = await Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
                preConfirm: async() => {
                    try {
                        await userService.delete(targetId)
                        return targetId
                    } catch (error) {
                        console.error(error);
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                        });
                        return false
                    }
                }
            })
            if(value) {
                data.value = data.value.filter(({id}) => id !== targetId)
                Swal.fire({
                    title: "Removed",
                    text: "User removed",
                    icon: "success"
                });
            }
        });
    });

    async function userForm(user) {
        let roles
        if(user) roles = user.roles.map(role => role.name)

        const { value } = await Swal.fire({
            title: user ? "Edit Admin" : "New Admin",
            confirmButtonText: 'Save',
            html: `
                <form>
                    <div>
                        <label for="swal-input-name">Name:</label>
                        <input type="text" id="swal-input-name" class="swal2-input" value="${user ? user.name : ''}">
                    </div>
                    <div>
                        <label for="swal-input-email">Email:</label>
                        <input type="email" id="swal-input-email" class="swal2-input" value="${user ? user.email : ''}">
                    </div>
                    <div>
                        <label for="swal-input-password">Password:</label>
                        <input type="password" id="swal-input-password" class="swal2-input">
                    </div>
                    <div>
                        <label for="swal-input-password-confirmation">Confirm Password:</label>
                        <input type="password" id="swal-input-password-confirmation" class="swal2-input">
                    </div>
                    <div>
                        <label>Role:</label>
                        <div>
                            <div>
                                <input type="checkbox" id="swal-checkbox-admin" ${user && roles.includes('admin') ? 'checked' : ''}>
                                <label for="swal-checkbox-admin">Admin</label>
                            </div>
                            <div>
                                <input type="checkbox" id="swal-checkbox-writer" ${user && roles.includes('writer') ? 'checked' : ''}>
                                <label for="swal-checkbox-writer">Writer</label>
                            </div>
                        </div>
                    </div>
                </form>
            `,
            width:'60%',
            focusConfirm: false,
            preConfirm: async () => {
                const password = document.getElementById("swal-input-password").value;
                const password_confirmation  = document.getElementById("swal-input-password-confirmation").value;
                if (password !== password_confirmation ) {
                    Swal.showValidationMessage("Passwords do not match")
                    return false
                }

                try {
                    const body = {
                        name: document.getElementById("swal-input-name").value,
                        email: document.getElementById("swal-input-email").value,
                        password,
                        password_confirmation,
                        role_admin: document.getElementById("swal-checkbox-admin").checked,
                        role_writer: document.getElementById("swal-checkbox-writer").checked,
                    }
                    let responseUser;

                    if(user) {
                        responseUser = await userService.update(user.id, body)
                    } else {
                        responseUser = await userService.store(body)
                    }
                    
                    return {
                        responseUser,
                        password
                    };
                } catch (error) {
                    let message = error.response.data.message.replace(/\([^)]*\)/g, '')
                    Swal.showValidationMessage(message)
                    return false
                }
            }
        });
        if (value) {
            if(user) {
                const index = data.value.findIndex(({id}) => id === value.responseUser.id)
                data.value[index] = value.responseUser
            } else {
                data.value.push(value.responseUser)
            }
            let html = `
                    <p>Name: ${value.responseUser.name}</p>
                    <p>Email: ${value.responseUser.email}</p>
                `
            if(value.password) html += `<p>Password: ${value.password}</p>`
            Swal.fire({
                title: user ? "Admin updated" : "Admin created",
                html,
                icon: "success"
            });
        }
    }
</script>
