import {Stack} from "@mui/material"
import useApiResource from "../../../../api/useApiResource"
import ResourcePagination from "../../ResourcePagination"
import React, {useState} from "react"
import Button from "@mui/material/Button"
import AddCircleOutlineIcon from "@mui/icons-material/AddCircleOutline"
import Search from "../../../shared/SearchFields/Search"
import CategoryForm from "./CategoryForm"
import RemoveCategoryDialog from "./RemoveCategoryDialog"
import CategoryTable from "./CategoryTable"
import LoadingSwitch from "../../../shared/Loading/LoadingSwitch"

function CategoryArea({operationId}) {

    const primaryCategoriesIds = [1, 2]
    const url = '/client_resources/categories'
    const initQuery = {
        pagination: 10,
        sort: 'name-asc',
        relations: {
            operation_id: operationId
        },
        include: ['operation']
    }
    const {
        status,
        meta,
        items,
        query,
        error,
        getItemById,
        changeSort,
        changeFilters,
        changePage,
        create,
        update,
        remove} = useApiResource(url, initQuery)

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
    const openUpdateForm = (id) => {
        const item = getItemById(id)
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

    const openRemoveItemDialog = (id) => {
        const item = getItemById(id)
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
                <LoadingSwitch
                    status={status}
                    completed={
                        <CategoryTable
                            editHandler={openUpdateForm}
                            removeHandler={openRemoveItemDialog}
                            sortHandler={changeSort}
                            items={excludePrimaryCategories(items)}
                            sort={query.sort}
                        />
                    }
                    error=""
                />
            </Stack>
        </>
    )
}

export default CategoryArea