import {IconButton, Stack, Typography} from "@mui/material";
import AccountCircleIcon from '@mui/icons-material/AccountCircle';

function ProfileLogo() {
    return (
        <IconButton color="negative" size="large">
            <Stack direction="row"
                   justifyContent="center"
                   alignItems="center"
                   spacing={1}
            >
                <AccountCircleIcon fontSize="large"/>
                <Typography>
                    Fake user
                </Typography>
            </Stack>
        </IconButton>
    );
};

export default ProfileLogo;
