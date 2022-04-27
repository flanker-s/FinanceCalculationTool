import React from 'react'
import ReactDOM from 'react-dom/client'
import './index.css'
import App from './App'
import {ThemeProvider} from "@mui/material";
import {fctTheme} from "./themes/fctTheme";
import {NavigationProvider} from "./contexts/NavigationContext";

const root = ReactDOM.createRoot(document.getElementById('root'))

root.render(
    <React.StrictMode>
        <NavigationProvider>
            <ThemeProvider theme={fctTheme}>
                <App/>
            </ThemeProvider>
        </NavigationProvider>
    </React.StrictMode>
);