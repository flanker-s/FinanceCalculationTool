import React from 'react'
import ReactDOM from 'react-dom/client'
import './index.css'
import App from './App'
import {ThemeProvider} from "@mui/material";
import {fctTheme} from "./app/themes/fctTheme";
import {NavigationProvider} from "./app/providers/Navigation/NavigationContext";
import {AuthProvider} from "./app/providers/Authentication/AuthContext";
import {BrowserRouter as Router} from "react-router-dom";

const root = ReactDOM.createRoot(document.getElementById('root'))

root.render(
    <React.StrictMode>
        <AuthProvider>
            <NavigationProvider>
                <Router>
                    <ThemeProvider theme={fctTheme}>
                        <App/>
                    </ThemeProvider>
                </Router>
            </NavigationProvider>
        </AuthProvider>
    </React.StrictMode>
);