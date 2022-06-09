import {TableCell} from "@mui/material/index"
import {Button, Stack, TableRow} from "@mui/material"
import EditIcon from "@mui/icons-material/Edit"
import DeleteIcon from "@mui/icons-material/Delete"

function SortingTableRow({id, properties, editHandler, removeHandler}) {

    const handleEdit = () => editHandler(id)
    const handleRemove = () => removeHandler(id)

    return (
        <TableRow>
            {properties.map((property, i) => {
                return (
                    <TableCell
                        key={i}
                    >
                        {property}
                    </TableCell>
                )
            })}
            <TableCell align="right">
                <Stack direction="row" justifyContent="flex-end">
                    <Button onClick={handleEdit}>
                        <EditIcon />
                    </Button>
                    <Button onClick={handleRemove}>
                        <DeleteIcon />
                    </Button>
                </Stack>
            </TableCell>
        </TableRow>
    )
}

export default SortingTableRow