const checkLoginStatus = async (forbiddenPage) => {
    const res = await fetch('./backend/loginStatus.php', {method: "GET",})
    const data = await res.json()

    if (forbiddenPage === "login" && data.status === 'loggedIn') location = "/"
    else if (forbiddenPage === "admin" && data.account_type !== 'admin') location = "/"
    else if (forbiddenPage === "home" && data.account_type === 'admin') location = "/#/admin"
    else if (forbiddenPage === "userPanel" && data.account_type !== 'default') location = "/"

    if (data.status === 'loggedIn') {

        // console.log(data.id, data.user, data.account_type)

        return {
            id: data.id,
            user: data.user,
            accountType: data.account_type,
            status: true
        }
    } else {
        return {
            status: false
        }
    }
}

export default checkLoginStatus