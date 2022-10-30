import {Paper, Table, TableBody, TableContainer, TableHead, TableRow, TableCell} from "@mui/material"
import SortingTableRow from "./SortingTableRow"
import SortingTableColumn from "./SortingTableColumn"

function SortingTable({
                          tableItems,
                          orderBy = 'name',
                          order = 'asc',
                          sortHandler,
                          editHandler,
                          removeHandler
}) {

    const handleEdit = id => editHandler(id)
    const handleRemove = id => removeHandler(id)

    const columns = tableItems[0]?.properties?.map((item, i) => {
        return (
            <SortingTableColumn
                key={i}
                name={item.tableName}
                sortId={item.sortId}
                orderBy={orderBy}
                order={order}
                sortChangeHandler={sortHandler}
            />
        )
    })

    const rows = tableItems.map((item, i) => {
        const id = item.id
        const properties = item?.properties?.map(prop=>prop.value)
        return (
            <SortingTableRow
                key={i}
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
                        <TableCell align="right" sx={{paddingRight: "24pt"}}>
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