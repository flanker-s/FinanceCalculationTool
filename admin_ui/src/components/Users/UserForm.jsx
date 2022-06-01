import useFormData from "../Forms/hooks/useFormData"
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

function UserForm({
                      title,
                      id,
                      initUserName,
                      handleClose,
                      handleAccept,
                      initEmail
                  }
) {
    const {data, changeProperties} = useFormData(
        {
            name: initUserName,
            email: initEmail
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
                    label="Email"
                    type="text"
                    fullWidth
                    variant="standard"
                    value={data.email}
                    onChange={e => changeProperties({email: e.target.value})}
                />
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
                <TextField
                    autoFocus
                    margin="dense"
                    label="Password"
                    type="text"
                    fullWidth
                    variant="standard"
                    value={data.password}
                    onChange={e => changeProperties({password: e.target.value})}
                />
            </DialogContent>
            <DialogActions>
                <Button onClick={handleClose}>Cancel</Button>
                <Button onClick={() => accept()}>Accept</Button>
            </DialogActions>
        </Dialog>
    )
}

export default UserForm