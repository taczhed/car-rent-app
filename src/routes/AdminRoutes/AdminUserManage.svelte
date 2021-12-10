<script>
    import checkLoginStatus from "../../Functions/LoginCheck";
    import UserTableRow from "../../components/UserComponents/UserTableRow.svelte";
    import UsersManagingTableRow from "../../components/AdminComponents/AdminUsersManagingTableRow.svelte";

    const reload = async () => {
        await fetchUserList('UserList')
    }

    const fetchUserList = async (type) => {
        const userData = await checkLoginStatus('userList')
        let data = new FormData()
        data.append('user_id', userData.id)
        const res = await fetch(`./backend/fetch${type}.php`, {method: "POST", body: data})
        data = await res.json()
        if (type === 'UserList') reqestedUsers = data
        console.log('pobieram...')
        return data
    }

    let reqestedUsers = fetchUserList('UserList')

</script>

<div class="w-full flex flex-col justify-center align-center">
    <h1 class="text-center text-4xl font-bold p-8 bg-gray-600 text-white">Użytkownicy</h1>
    <table class="bg-gray-500">
        <thead class="bg-gray-300"><tr>
            <th class="px-6 py-2 text-xs text-gray-500">Id</th>
            <th class="px-6 py-2 text-xs text-gray-500">E-mail</th>
            <th class="px-6 py-2 text-xs text-gray-500">Typ</th>
            <th class="px-6 py-2 text-xs text-gray-500">Zwiększ uprawnienia</th>
        </tr></thead>
        <tbody class="bg-white">
        {#await reqestedUsers}
            <h1>Loading reqestedUsers...</h1>
        {:then res}
            {#if res.length !== 0}
                {#each res as data, i}
                    <UsersManagingTableRow
                        userId={data.userId}
                        email={data.email}
                        accountType={data.accountType}
                        reload={reload}
                    />
                {/each}
            {/if}
        {/await}
        </tbody>
    </table>
</div>
