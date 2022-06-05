import {useState} from "react"
import UserForm from "./UserForm"
import RemoveUserDialog from "./RemoveUserDialog"
import {Stack} from "@mui/material"
import Search from "../../../components/shared/SearchFields/Search"
import Button from "@mui/material/Button"
import ResourcePagination from "../../../components/shared/Resources/ResourcePagination"
import AddCircleOutlineIcon from "@mui/icons-material/AddCircleOutline"
import ResourceTable from "../../../components/shared/Resources/ResourceTable"
import useApiResource from "../../../api/useApiResource"

function UserArea() {

    const url = '/users'
    const query = {
        paginate: 10,
    }
    const {status, meta, items, error, changeFilters, changePage, create, update, remove} = useApiResource(url, query)

    const [userForm, setUserForm] = useState()
    const [removeUserDialog, setRemoveUserDialog] = useState()

    const closeTemplateForm = () => {
        setUserForm(null)
    }

    const openCreateForm = () => {
        setUserForm(
            <UserForm
                title="Create category"
                handleClose={closeTemplateForm}
                handleAccept={data => create(data)}
            />
        )
    }
    const openUpdateForm = (item) => {
        setUserForm(
            <UserForm
                title="Update category"
                handleClose={closeTemplateForm}
                handleAccept={data => update(item.id, data)}
                id={item.id}
                initUserName={item.attributes.name}
                initEmail={item.attributes.email}
            />
        )
    }

    const openRemoveItemDialog = (item) => {
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
                <ResourceTable
                    editHandler={openUpdateForm}
                    removeHandler={openRemoveItemDialog}
                    status={status}
                    items={items}
                    allowedFields={{
                        name: 'Name',
                        email: 'Email',
                        created_at: 'Created at',
                        id: 'Id',
                    }}
                    error={error}
                />
            </Stack>
        </>
    )
}

export default UserArea