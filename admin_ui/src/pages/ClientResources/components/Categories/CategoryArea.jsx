import ResourceTable from "../../../../components/shared/Resources/ResourceTable"
import {Stack} from "@mui/material"
import useApiResource from "../../../../api/useApiResource"
import ResourcePagination from "../../../../components/shared/Resources/ResourcePagination"
import React, {useState} from "react"
import Button from "@mui/material/Button"
import AddCircleOutlineIcon from "@mui/icons-material/AddCircleOutline"
import Search from "../../../../components/shared/SearchFields/Search"
import CategoryForm from "./CategoryForm"
import RemoveCategoryDialog from "./RemoveCategoryDialog"

function CategoryArea({operationId, tableParams}) {

    const primaryCategoriesIds = [1, 2]
    const url = '/client_resources/categories'
    const query = {
        paginate: 10,
        filter: {
            operation_id: operationId
        },
        include: ['operation']
    }
    const {status, meta, items, error, changeFilters, changePage, create, update, remove} = useApiResource(url, query)

    const [categoryForm, setCategoryForm] = useState()
    const [removeItemDialog, setRemoveItemDialog] = useState()

    const closeTemplateForm = () => {
        setCategoryForm(null)
    }

    const openCreateForm = () => {
        setCategoryForm(
            <CategoryForm
                title="Create category"
                operationId={operationId}
                handleClose={closeTemplateForm}
                handleAccept={data => create(data)}
            />
        )
    }
    const openUpdateForm = (item) => {
        setCategoryForm(
            <CategoryForm
                title="Update category"
                handleClose={closeTemplateForm}
                handleAccept={data => update(item.id, data)}
                id={item.id}
                initCategoryName={item.attributes.name}
            />
        )
    }

    const openRemoveItemDialog = (item) => {
        setRemoveItemDialog(
            <RemoveCategoryDialog
                item={item}
                itemColor="red"
                closeHandler={closeRemoveItemDialog}
                acceptHandler={acceptRemove}
            />
        )
    }

    const closeRemoveItemDialog = () => {
        setRemoveItemDialog(null)
    }

    const acceptRemove = (id) => {
        remove(id)
    }

    const excludePrimaryCategories = (items) => {
        return items?.filter(item => !primaryCategoriesIds.includes(item.id))
    }

    return (
        <>
            {categoryForm}
            {removeItemDialog}
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
                    items={excludePrimaryCategories(items)}
                    allowedFields={tableParams.fields}
                    error={error}
                />
            </Stack>
        </>
    )
}

export default CategoryArea