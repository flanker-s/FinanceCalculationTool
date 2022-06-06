import React from 'react'
import ConfirmDialog from "../../../../app/components/shared/Dialogs/СonfirmDialog"
import Typography from "@mui/material/Typography"
import {DialogContentText} from "@mui/material"

function RemoveCategoryDialog({item, closeHandler, acceptHandler}) {
    const name = item?.attributes?.name
    const id = item?.id
    const operationId = item?.included?.operation?.id
    const color = operationId === 1 ? "green" : operationId === 2 ? "red" : "grey"

    const content = (
        <DialogContentText id="alert-dialog-description">
            Are you sure you want to delete item {
            <Typography
                component="span"
                sx={{
                    fontWeight: "bold",
                    color: {color}
                }}
            >
                {name}
            </Typography>
        } with id:{
            <Typography
                component="span"
                sx={{fontWeight: "bold"}}
            >
                {id}
            </Typography>
        }?
        </DialogContentText>
    )

    const handleAccept = () => {
        acceptHandler(id)
        closeHandler()
    }

    return (
        <ConfirmDialog
            title="Delete template"
            content={content}
            closeHandler={closeHandler}
            acceptHandler={handleAccept}
        />
    )
}

export default RemoveCategoryDialog