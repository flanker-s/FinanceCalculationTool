import {Stack, TextField} from "@mui/material"

function Search({searchHandler}) {
    return (
        <Stack direction='row'>
            <TextField
                label='Search'
                onChange={e => searchHandler(e.target.value)}
                InputProps={{
                    type: 'search',
                }}
            >
            </TextField>
        </Stack>
    )
}

export default Search