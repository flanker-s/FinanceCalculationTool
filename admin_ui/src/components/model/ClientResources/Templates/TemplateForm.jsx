import useFormData from "../../../../hooks/FormData/useFormData"
import {
    Dialog,
    DialogActions,
    DialogContent,
    DialogContentText,
    DialogTitle,
    Stack,
    TextField
} from "@mui/material"
import Button from "@mui/material/Button"
import React from "react"
import ResourceSelect from "../../ResourceSelect"

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

    const {data, changeProperties} = useFormData(
        {
            name: initTemplateName,
            category_id: initCategoryId
        }
    )

    const handleCategorySelect = (id) => {
        changeProperties({category_id: id})
    }

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
                <Stack spacing={1}>
                    <TextField
                        autoFocus
                        margin="dense"
                        label="Name"
                        type="text"
                        fullWidth
                        variant="outlined"
                        value={data.name}
                        onChange={e => changeProperties({name: e.target.value})}
                    />
                    <ResourceSelect
                        url="/client_resources/categories"
                        label="category"
                        initQuery={{
                            filter: {
                                operation_id: operationId
                            },
                        }}
                        initSelected={initCategoryId}
                        selectHandler={handleCategorySelect}
                        fullWidth
                    />
                </Stack>
            </DialogContent>
            <DialogActions>
                <Button onClick={handleClose}>Cancel</Button>
                <Button onClick={() => accept()}>Accept</Button>
            </DialogActions>
        </Dialog>
    )
}

export default TemplateForm