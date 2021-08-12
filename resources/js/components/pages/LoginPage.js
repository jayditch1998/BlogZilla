import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import Button from '@material-ui/core/Button';
import Container from '@material-ui/core/Container';
import Grid from '@material-ui/core/Grid';
import TextField from '@material-ui/core/TextField';
import { AppBar,Toolbar, Typography, FormLabel, Box, Link,ThemeProvider } from '@material-ui/core';
import { makeStyles } from '@material-ui/core/styles';
import axios from 'axios';
import { SwapCalls } from '@material-ui/icons';
import Swal from 'sweetalert2'
import api from '../../config/api';
import { data } from 'jquery';

function LoginPage(){
    const [loginInput, setLogin] = useState({
        email: '',
        password: '',
    });

    const handleInput = (e) => {
        e.persist();
        setLogin({...loginInput, [e.target.name]: e.target.value});
    }

    const loginSubmit = (e) => {
        e.preventDefault();
        // console.log('loginInput', loginInput);

        api.post('/author/post/login', {
            'email': loginInput.email,
            'password': loginInput.password,
        }).then((result) => {
            console.log('this is the result', result);
            // window.location.replace('/');
            if(result.ok && result.data.status === 200 && result.data.message === '3'){
                // console.log('success');
                window.location.replace('/');
            }else if(result.data.status === 200 && result.data.message === '2'){
                window.location.replace('/author');
            }
        });
    }
    return(
        <Container maxWidth="xs">
            <AppBar color="secondary">
                <Toolbar>
                    <Typography color="initial" variant='body1'>
                        BlogZilla
                    </Typography>
                </Toolbar>
            </AppBar>
            <form onSubmit={loginSubmit} method="POST">
                <Box mt={8}><h1>LogIn</h1></Box>
                <Grid container spacing={3}>
                    <Grid item xs={12}>
                        <Grid container spacing={2}>
                            <Grid item xs={12}>
                                <TextField fullWidth label="Email" name="email" onChange={handleInput} value={loginInput.email} size="small" variant="outlined"/>
                                {/* <span>{loginInput.error_list.email}</span> */}
                            </Grid>
                            <Grid item xs={12}>
                                <TextField
                                 fullWidth label="password" name="password"  type="password" onChange={handleInput}  value={loginInput.password} size="small" variant="outlined"
                                 />
                                 {/* <span>{loginInput.error_list.password}</span> */}
                            </Grid>
                        </Grid>
                    </Grid>
                    <Grid item xs={12}>
                        <Button color="secondary" fullWidth type="submit" variant="contained">
                            Log In
                        </Button>
                        <Box display="flex" justifyContent="center" alignItems="center">
                            <Link color="inherit" href='/register'>
                               or Register
                            </Link>
                        </Box>
                    </Grid>
                </Grid>
            </form>
        </Container>
    );
}

export default LoginPage;

if (document.getElementById('app')) {
    ReactDOM.render(<LoginPage />, document.getElementById('app'));
  }