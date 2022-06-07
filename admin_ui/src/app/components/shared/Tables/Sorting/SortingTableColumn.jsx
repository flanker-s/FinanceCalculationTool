import {TableCell, TableSortLabel} from "@mui/material/index"

function SortingTableColumn({
                                name,
                                sortId = 'name',
                                orderBy = 'name',
                                order = 'desc',
                                sortChangeHandler
}) {
    return (
        <TableCell
            key={sortId}
        >
            <TableSortLabel
                active={orderBy === sortId}
                direction={orderBy === sortId ? order : 'asc'}
                onClick={sortChangeHandler(sortId)}
            >
                {name}
            </TableSortLabel>
        </TableCell>
    )
}

export default SortingTableColumn