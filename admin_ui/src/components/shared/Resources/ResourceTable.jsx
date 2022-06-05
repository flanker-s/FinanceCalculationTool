import {Button, Paper, Table, TableBody, TableCell, TableContainer, TableHead, TableRow} from "@mui/material"
import EditIcon from '@mui/icons-material/Edit';
import DeleteIcon from '@mui/icons-material/Delete';
import Loading from "../../../pages/Loading/Loading"
import moment from "moment"

function ResourceTable({status, items, allowedFields, error, editHandler, removeHandler}) {

    switch (status) {
        case 'processing':
            return (<Loading/>)
        case 'completed':
            return items ? (
                <TableContainer component={Paper}>
                    <Table sx={{minWidth: 650}} aria-label="simple table">
                        <TableHead>
                            <TableRow>
                                {Object.keys(allowedFields).map((propertyName, i) => {
                                    if (i === 0) {
                                        return (<TableCell key={i}>{allowedFields[propertyName]}</TableCell>)
                                    } else {
                                        return (<TableCell key={i} align="right">{allowedFields[propertyName]}</TableCell>)
                                    }
                                })}
                                <TableCell align='center'>Options</TableCell>
                            </TableRow>
                        </TableHead>
                        <TableBody>
                            {items.map((item) => (
                                <TableRow
                                    key={item.id}
                                    sx={{'&:last-child td, &:last-child th': {border: 0}}}
                                >
                                    {Object.keys(allowedFields).map((propertyName, i) => {
                                        const value = parseResourceProperty(item, propertyName)
                                        if (i === 0) {
                                            return (
                                                <TableCell key={i} component="th" scope="row">
                                                    {convertIfTime(value)}
                                                </TableCell>
                                            )
                                        } else {
                                            return (
                                                <TableCell key={i} align="right">
                                                    {convertIfTime(value)}
                                                </TableCell>
                                            )
                                        }
                                    })}
                                    <TableCell align="right">
                                        <Button onClick={()=>editHandler(item)}>
                                            <EditIcon />
                                        </Button>
                                        <Button onClick={()=>removeHandler(item)}>
                                            <DeleteIcon />
                                        </Button>
                                    </TableCell>
                                </TableRow>
                            ))}
                        </TableBody>
                    </Table>
                </TableContainer>
            ) : ''
        case 'error':
            return (<div>{JSON.stringify(error)}</div>)
    }
}

function parseResourceProperty(item, propertyName){
    const include = item?.included?.[propertyName]?.attributes?.name
    const main = item?.[propertyName]
    const attribute = item?.attributes?.[propertyName]
    return main ?? attribute ?? include
}

function convertIfTime(value){
    if(moment(value, moment.ISO_8601, true).isValid()){
        return moment(value).format("MMM Do YYYY");
    } else {
        return value
    }
}

export default ResourceTable