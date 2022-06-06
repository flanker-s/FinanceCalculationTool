import React, {useContext} from 'react';
import {ListItem, List} from "@mui/material"
import NavigationMenuItem from "./NavigationMenuItem"
import NavigationContext from "../../../../../providers/Navigation/NavigationContext"

function NavigationMenu({direction}) {
    const {routes} = useContext(NavigationContext)
    return (
        <nav>
            <List sx={{
                display: "flex",
                flexDirection: direction,
                alignItems: "end",
                padding: 0
            }}>
                {Object.keys(routes).map((routeName, index) => {
                    return (
                        <ListItem
                            key={"navbar-item-" + index}
                            sx={{
                                width: "auto",
                                paddingTop: "0",
                            }}
                        >
                            <NavigationMenuItem
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
