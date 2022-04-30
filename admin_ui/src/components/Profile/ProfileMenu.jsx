import * as React from 'react'
import Button from '@mui/material/Button'
import Menu from '@mui/material/Menu'
import MenuItem from '@mui/material/MenuItem'
import ProfileLogo from "./ProfileLogo"
import AuthContext from "../../contexts/AuthContext"
import {useContext} from "react"

function ProfileMenu() {
    const [anchorEl, setAnchorEl] = React.useState(null);
    const open = Boolean(anchorEl);
    const handleClick = (event) => {
        setAnchorEl(event.currentTarget);
    };
    const handleClose = () => {
        setAnchorEl(null);
    };

    const {logOut} = useContext(AuthContext)

    return (
        <div>
            <Button
                id="profile-button"
                aria-controls={open ? 'profile-menu' : undefined}
                aria-haspopup="true"
                aria-expanded={open ? 'true' : undefined}
                onClick={handleClick}
                style={{textTransform: 'none'}}
            >
                <ProfileLogo />
            </Button>
            <Menu
                id="basic-menu"
                anchorEl={anchorEl}
                open={open}
                onClose={handleClose}
                MenuListProps={{
                    'aria-labelledby': 'profile-button',
                }}
            >
                <MenuItem onClick={handleClose}>TODO: Profile</MenuItem>
                <MenuItem onClick={handleClose}>TODO: My account</MenuItem>
                <MenuItem onClick={logOut}>Logout</MenuItem>
            </Menu>
        </div>
    );
}

export default ProfileMenu