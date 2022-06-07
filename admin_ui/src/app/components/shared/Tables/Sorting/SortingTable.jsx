import {Paper, Table, TableBody, TableContainer, TableHead, TableRow, TableCell} from "@mui/material"
import SortingTableRow from "./SortingTableRow"
import SortingTableColumn from "./SortingTableColumn"

function SortingTable({
                          tableItems,
                          orderBy,
                          order = 'asc',
                          sortHandler,
                          editHandler,
                          removeHandler
}) {

    const handleSortChange = () => {

    }
    const handleEdit = id => editHandler(id)
    const handleRemove = id => removeHandler(id)

    const columns = tableItems[0]?.properties?.map(item => {
        return (
            <SortingTableColumn
                name={item.tableName}
                sortId={item.sortId}
                sortChangeHandler={handleSortChange}
            />
        )
    })

    const rows = tableItems.map((item) => {
        const id = item.id
        const properties = item?.properties?.map(prop=>prop.value)
        return (
            <SortingTableRow
                id={id}
                properties={properties}
                editHandler={handleEdit}
                removeHandler={handleRemove}
            />
        )
    })

    return (
        <TableContainer component={Paper}>
            <Table sx={{minWidth: 650}} aria-label="simple table">
                <TableHead>
                    <TableRow>
                        {columns}
                        <TableCell>
                            Options
                        </TableCell>
                    </TableRow>
                </TableHead>
                <TableBody>
                    {rows}
                </TableBody>
            </Table>
        </TableContainer>
    )
}

export default SortingTable