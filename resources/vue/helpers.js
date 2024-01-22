export function userHasRole(user, permission) {
    const roles = user.roles
    const found = roles.find(({name}) => name === permission)
    return found ? true : false
}

export function userHasPermission(user, permission) {
    const roles = user.roles
    const allPermissions = []

    roles.forEach(({permissions}) => {
        permissions.forEach(({name}) => {
            if(!allPermissions.includes(name)) allPermissions.push(name)
        })
    });

    return allPermissions.includes(permission)
}