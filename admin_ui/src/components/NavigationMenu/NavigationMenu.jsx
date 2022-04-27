import React, {useContext} from 'react';
import {ListItem, List} from "@mui/material"
import NavigationButton from "./NavigationButton"
import NavigationContext from "../../contexts/NavigationContext"

function NavigationMenu({direction}) {
    const {routes} = useContext(NavigationContext)
    return (
        <nav>
            <List sx={{display: "flex", flexDirection: direction, padding: 0}}>
                {Object.keys(routes).map((routeName, index) => {
                    return (
                        <ListItem
                            key={"navbar-item-" + index}
                        >
                            <NavigationButton
                                routeName={routeName}
                                url={routes[routeName]}
                            />
                        </ListItem>
                    )
                })}
            </List>
        </nav>
    );
}

NavigationMenu.defaultProps = {
    direction: "row"
}

export default NavigationMenu;
