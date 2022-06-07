import {TableCell, TableSortLabel} from "@mui/material/index"

function SortingTableColumn({
                                name,
                                sortId = 'name',
                                orderBy = 'name',
                                order = 'asc',
                                sortChangeHandler
}) {
    const defaultOrder = 'asc'
    const handleSortChange = () => {
        if(sortId === orderBy){
            sortChangeHandler(sortId, invertOrder(order))
        } else {
            sortChangeHandler(sortId, defaultOrder)
        }
    }
    return (
        <TableCell
            key={sortId}
        >
            <TableSortLabel
                active={orderBy === sortId}
                //invert direction just to invert arrow icon
                direction={orderBy === sortId ? invertOrder(order) : invertOrder(defaultOrder)}
                onClick={handleSortChange}
            >
                {name}
            </TableSortLabel>
        </TableCell>
    )
}

function invertOrder(order){
    return order === 'asc' ? 'desc' : 'asc'
}

export default SortingTableColumn