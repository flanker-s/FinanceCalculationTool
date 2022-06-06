import {Stack, Typography} from '@mui/material'
import {capitalize} from "@mui/material"
import AccountCircleIcon from '@mui/icons-material/AccountCircle'
import AuthContext from "../../../providers/Authentication/AuthContext"
import {useContext} from "react"
import Box from "@mui/material/Box"
import {useTheme} from "@emotion/react"

function ProfileLogo() {
    const {user} = useContext(AuthContext)
    const theme = useTheme()

    return (
        <Box sx={{
            color: theme.palette.negative.main
        }}>
            <Stack direction="row"
                   justifyContent="center"
                   alignItems="center"
                   spacing={1}
            >
                <AccountCircleIcon fontSize="large"/>
                <Typography>
                    {capitalize(user.attributes.name)}
                </Typography>
            </Stack>
        </Box>
    )
}

export default ProfileLogo
