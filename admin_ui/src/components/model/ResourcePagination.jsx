import {Pagination} from "@mui/material"

function ResourcePagination({meta, changePageHandler, sx}) {
    if(meta?.last_page){
        return (
            <Pagination
                sx={sx}
                count={meta.last_page}
                page={meta?.current_page}
                onChange={changePageHandler}
                variant="outlined"
                shape="rounded"
            />
        )
    }
}

export default ResourcePagination