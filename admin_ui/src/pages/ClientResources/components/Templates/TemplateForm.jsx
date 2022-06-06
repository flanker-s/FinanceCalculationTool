import useFormData from "../../../../app/hooks/FormData/useFormData"
import {
    Dialog,
    DialogActions,
    DialogContent,
    DialogContentText,
    DialogTitle,
    FormControl,
    InputLabel,
    Select, TextField
} from "@mui/material"
import Button from "@mui/material/Button"
import MenuItem from "@mui/material/MenuItem"
import useApiResource from "../../../../app/api/useApiResource"
import Loading from "../../../Loading/Loading"
import React from "react"

function TemplateForm({
                          title,
                          id,
                          operationId,
                          initTemplateName = '',
                          initCategoryId = '',
                          handleClose,
                          handleAccept
                      }
) {
    const {status, items} = useApiResource(
        '/client_resources/categories',
        {
            filter: {
                operation_id: operationId
            }
        }
    )
    const {data, changeProperties} = useFormData(
        {
            name: initTemplateName,
            category_id: initCategoryId
        }
    )

    const accept = () => {
        handleAccept(data)
        handleClose()
    }
    switch (status) {
        case 'processing':
            return <Loading/>
        case 'completed':
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
                            onChange={e=>changeProperties({name: e.target.value})}
                        />
                        <FormControl variant="standard" fullWidth>
                            <InputLabel>Category</InputLabel>
                            <Select
                                labelId="demo-simple-select-label"
                                id="demo-simple-select"
                                label="Age"
                                value={data.category_id}
                                onChange={e=>changeProperties({category_id: e.target.value})}
                            >
                                {items.map((item, i) => {
                                    return <MenuItem key={i} value={item.id}>{item.attributes.name}</MenuItem>
                                })}
                            </Select>
                        </FormControl>
                    </DialogContent>
                    <DialogActions>
                        <Button onClick={handleClose}>Cancel</Button>
                        <Button onClick={() => accept()}>Accept</Button>
                    </DialogActions>
                </Dialog>
            )
    }
}

export default TemplateForm