import React from 'react'
import {CircularProgress, Box} from "@mui/material"
import Typography from "@mui/material/Typography"

function Loading() {
    return (
        <Box sx={{
            position: "absolute",
            top: '50%',
            left: '50%',
            transform: 'translate(-50%, -50%)',
            display: 'flex',
            flexDirection: 'column',
            alignItems: 'center'
        }}>
            <Typography variant='h6'>
                Loading...
            </Typography>
            <CircularProgress />
        </Box>
    )
}

export default Loading