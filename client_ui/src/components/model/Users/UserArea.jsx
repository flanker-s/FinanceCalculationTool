import {useState} from "react"
import UserForm from "./UserForm"
import RemoveUserDialog from "./RemoveUserDialog"
import {Stack} from "@mui/material"
import Search from "../../shared/SearchFields/Search"
import Button from "@mui/material/Button"
import ResourcePagination from "../ResourcePagination"
import AddCircleOutlineIcon from "@mui/icons-material/AddCircleOutline"
import useApiResource from "../../../api/useApiResource"
import UserTable from "./UserTable"
import LoadingSwitch from "../../shared/Loading/LoadingSwitch"

function UserArea() {

    const url = '/users'
    const initQuery = {
        pagination: 10,
        sort: 'name-asc',
        include: ['abilities']
    }
    const {
        status,
        meta,
        query,
        items,
        error,
        getItemById,
        changeSort,
        changeFilters,
        changePage,
        create,
        update,
        remove
    } = useApiResource(url, initQuery)

    const [userForm, setUserForm] = useState()
    const [removeUserDialog, setRemoveUserDialog] = useState()

    const closeTemplateForm = () => {
        setUserForm(null)
    }

    const openCreateForm = () => {
        setUserForm(
            <UserForm
                title="Create user"
                handleClose={closeTemplateForm}
                handleAccept={data => create(data)}
            />
        )
    }
    const openUpdateForm = (id) => {
        const item = getItemById(id)
        setUserForm(
            <UserForm
                title="Update user"
                handleClose={closeTemplateForm}
                handleAccept={data => update(item.id, data)}
                id={item.id}
                initUserName={item.attributes.name}
                initEmail={item.attributes.email}
                initAbilityIds={item.included.abilities.map(ability => ability.id)}
            />
        )
    }

    const openRemoveItemDialog = (id) => {
        const item = getItemById(id)
        setRemoveUserDialog(
            <RemoveUserDialog
                item={item}
                itemColor="red"
                closeHandler={closeRemoveItemDialog}
                acceptHandler={acceptRemove}
            />
        )
    }

    const closeRemoveItemDialog = () => {
        setRemoveUserDialog(null)
    }

    const acceptRemove = (id) => {
        remove(id)
    }

    return (
        <>
            {userForm}
            {removeUserDialog}
            <Stack spacing={1}>
                <Search searchHandler={value => changeFilters({name: value})}/>
                <Button variant="contained" onClick={openCreateForm}>
                    <AddCircleOutlineIcon fontSize="large"/>
                </Button>
                <ResourcePagination
                    meta={meta}
                    changePageHandler={(e, value) => changePage(value)}
                    sx={{
                        marginLeft: 'auto !important',
                        marginRight: 'auto !important',
                    }}
                />
                <LoadingSwitch
                    status={status}
                    completed={
                        <UserTable
                            editHandler={openUpdateForm}
                            removeHandler={openRemoveItemDialog}
                            sortHandler={changeSort}
                            items={items}
                            sort={query.sort}
                        />
                    }
                    error=""
                />
            </Stack>
        </>
    )
}

export default UserArea