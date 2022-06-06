import React from 'react'
import {Dialog, DialogActions, DialogContent, DialogTitle} from "@mui/material"
import Button from "@mui/material/Button"

function ConfirmDialog({title, content, closeHandler, acceptHandler}) {
    return (
        <Dialog
            open={true}
            onClose={closeHandler}
            aria-labelledby="alert-dialog-title"
            aria-describedby="alert-dialog-description"
        >
            <DialogTitle id="alert-dialog-title">
                {title}
            </DialogTitle>
            <DialogContent>
                {content}
            </DialogContent>
            <DialogActions>
                <Button onClick={closeHandler}>Disagree</Button>
                <Button onClick={acceptHandler} autoFocus>Agree</Button>
            </DialogActions>
        </Dialog>
    )
}

export default ConfirmDialog