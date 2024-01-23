export function userHasRole(user, role) {
    const roles = user.roles
    const found = roles.find(({name}) => name === role)
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

export function getUserHome(user) {
    let home = null
    if( userHasRole(user, 'super admin') || userHasRole(user, 'admin')) {
        home = 'pass.index'
    } else if(userHasRole(user, 'writer')) {
        home = 'article.index'
    }
    return home
}

export function getUserRolesNames(user) {
    return user.roles.map(role => role.name)
}

export function getUserPermissionsNames(user) {
    const roles = user.roles
    const allPermissions = []

    roles.forEach(({permissions}) => {
        permissions.forEach(({name}) => {
            if(!allPermissions.includes(name)) allPermissions.push(name)
        })
    });

    return allPermissions
}