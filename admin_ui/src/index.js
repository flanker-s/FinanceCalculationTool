import React from 'react'
import ReactDOM from 'react-dom/client'
import './index.css'
import App from './App'
import {ThemeProvider} from "@mui/material";
import {fctTheme} from "./themes/fctTheme";
import {NavigationProvider} from "./contexts/NavigationContext";
import {AuthProvider} from "./contexts/AuthContext";
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