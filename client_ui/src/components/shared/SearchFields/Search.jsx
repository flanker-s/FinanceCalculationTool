import {Stack, TextField} from "@mui/material"

function Search({searchHandler, ...props}) {
    return (
        <Stack direction='row' {...props}>
            <TextField
                label='Search'
                onChange={e => searchHandler(e.target.value)}
                InputProps={{
                    type: 'search',
                }}
                sx={{
                    width: "100%"
                }}
            >
            </TextField>
        </Stack>
    )
}

export default Search