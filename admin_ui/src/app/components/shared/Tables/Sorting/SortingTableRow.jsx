import {TableCell} from "@mui/material/index"
import {Button, TableRow} from "@mui/material"
import EditIcon from "@mui/icons-material/Edit"
import DeleteIcon from "@mui/icons-material/Delete"

function SortingTableRow({id, properties, editHandler, removeHandler}) {

    const handleEdit = () => editHandler(id)
    const handleRemove = () => removeHandler(id)

    return (
        <TableRow>
            {properties.map((property) => {
                return (
                    <TableCell>
                        {property}
                    </TableCell>
                )
            })}
            <TableCell align="right">
                <Button onClick={handleEdit}>
                    <EditIcon />
                </Button>
                <Button onClick={handleRemove}>
                    <DeleteIcon />
                </Button>
            </TableCell>
        </TableRow>
    )
}

export default SortingTableRow