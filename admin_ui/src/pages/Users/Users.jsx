import React from 'react'
import UserArea from "../../components/model/Users/UserArea"
import BasicTabs from "../../components/shared/Tabs/BasicTabs"

function Users() {
    return (
        <BasicTabs tabs={{
            Users: <UserArea />,
        }}/>
    )
}

export default Users