import React from 'react';
import ReactDOM from 'react-dom';
import Button from '@material-ui/core/Button';
import Container from '@material-ui/core/Container';
import Grid from '@material-ui/core/Grid';
import TextField from '@material-ui/core/TextField';
import { AppBar,Toolbar, Typography, FormLabel, Box, InputLabel, Select, NativeSelect } from '@material-ui/core';
import { makeStyles } from '@material-ui/core/styles';
import { ThemeProvider } from '@material-ui/core/styles';
import { BrowserRouter as Router, Switch, Route, Link, Redirect, useHistory } from 'react-router-dom';

const useStyles = makeStyles((theme) => ({
    container:{
        padding: theme.spacing(3),
    },
}));

const LoginPage = () => {
    const classes = useStyles();
    
    return(
        <Container className={classes.container} maxWidth="xs">
            <AppBar color="secondary">
                <Toolbar>
                    <Typography color="initial" variant='body1'>
                        BlogZilla
                    </Typography>
                </Toolbar>
            </AppBar>
            <form>
                <Box mt={8}><h1>Register</h1></Box>
                <Grid container spacing={3}>
                    <Grid item xs={12}>
                        <Grid container spacing={2}>
                            <Grid item xs={12}>
                                <TextField fullWidth label="First Name" name="firstName" size="small" variant="outlined"/>
                            </Grid>
                            <Grid item xs={12}>
                                <TextField
                                 fullWidth label="Last Name" name="lastName" size="small" variant="outlined"
                                 />
                            </Grid>
                            <Grid item xs={12}>
                                <TextField
                                 fullWidth label="Middle Name" name="middleName" size="small" variant="outlined"
                                 />
                            </Grid>
                            <Grid item xs={12}>
                                <TextField
                                 fullWidth label="Email" name="email" type="email" size="small" variant="outlined"
                                 />
                            </Grid>
                            <Grid item xs={12}>
                                <TextField
                                 fullWidth label="Mobile" name="mobile" type="number" size="small" variant="outlined"
                                 />
                            </Grid>
                            <Grid item xs={12}>
                                <TextField
                                 fullWidth label="Password" name="password" type="password" size="small" variant="outlined"
                                 />
                            </Grid>
                            <Grid item xs={12}>
                            <InputLabel id="label">Role</InputLabel>
                            <NativeSelect id="select" fullWidth>
                            <option value="author">Author</option>
                            <option value="user">User</option>
                            </NativeSelect>
                            </Grid>
                        </Grid>
                    </Grid>
                    <Grid item xs={12}>
                        <Button color="secondary" fullWidth type="submit" variant="contained">
                            Register
                        </Button>
                        <Router>
                            <Link color="inherit" to='/register' >
                            {'Login'}
                            </Link>
                        </Router>
                    </Grid>
                </Grid>
            </form>
        </Container>
    );
};

export default LoginPage;

if (document.getElementById('register')) {
    ReactDOM.render(<LoginPage />, document.getElementById('register'));
  }