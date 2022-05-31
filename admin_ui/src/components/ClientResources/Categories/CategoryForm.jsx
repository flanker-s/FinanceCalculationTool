import useFormData from "../../Forms/hooks/useFormData"
import {
    Dialog,
    DialogActions,
    DialogContent,
    DialogContentText,
    DialogTitle,
    TextField
} from "@mui/material"
import Button from "@mui/material/Button"
import React from "react"

function CategoryForm({
                          title,
                          id,
                          initCategoryName = '',
                          operationId,
                          handleClose,
                          handleAccept
                      }
) {
    const {data, changeProperties} = useFormData(
        {
            name: initCategoryName,
            operation_id: operationId
        }
    )

    const accept = () => {
        handleAccept(data)
        handleClose()
    }

    return (
        <Dialog open={true} onClose={handleClose}>
            <DialogTitle>{title}</DialogTitle>
            <DialogContent>
                <DialogContentText>
                    {id ? 'ID: #' + id : ''}
                </DialogContentText>
                <TextField
                    autoFocus
                    margin="dense"
                    label="Name"
                    type="text"
                    fullWidth
                    variant="standard"
                    value={data.name}
                    onChange={e => changeProperties({name: e.target.value})}
                />
            </DialogContent>
            <DialogActions>
                <Button onClick={handleClose}>Cancel</Button>
                <Button onClick={() => accept()}>Accept</Button>
            </DialogActions>
        </Dialog>
    )
}

export default CategoryForm