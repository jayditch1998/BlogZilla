import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import Button from '@material-ui/core/Button';
import Container from '@material-ui/core/Container';
import Grid from '@material-ui/core/Grid';
import TextField from '@material-ui/core/TextField';
import { AppBar,Toolbar, Typography, FormLabel, Box, InputLabel, Select, NativeSelect, Link } from '@material-ui/core';
import { makeStyles } from '@material-ui/core/styles';
import { Alert } from '@material-ui/lab';
import { ThemeProvider } from '@material-ui/core/styles';
import api from '../../config/api';

const useStyles = makeStyles((theme) => ({
    container:{
        padding: theme.spacing(3),
    },
}));

function RegistrationPage(){
    const classes = useStyles();
    
    const [firstName, setFirstName] = useState("");
    const [lastName, setLastName] = useState("");
    const [middleName, setMiddleName] = useState("");
    const [email, setEmail] = useState("");
    const [mobile, setMobile] = useState("");
    const [password, setPassword] = useState("");
    const [role, setRole] = useState("");



    const handleInput = (e) => {
        e.persist();
        setFirstName({...firstName, [e.target.name]: e.target.value});
        setLastName({...lastName, [e.target.name]: e.target.value});
        setMiddleName({...middleName, [e.target.name]: e.target.value});
        setEmail({...email, [e.target.name]: e.target.value});
        setMobile({...mobile, [e.target.name]: e.target.value});
        setPassword({...password, [e.target.name]: e.target.value});
        setRole({...role, [e.target.name]: e.target.value});
    }
    
    const registrationSubmit = (e) => {
        e.preventDefault();
        console.log('firstName', firstName);
        console.log('role', role);

        api.post('/post/register', {
            'firstName' : firstName.firstName,
            'lastName' : lastName.lastName,
            'middleName' : middleName.middleName,
            'email' : email.email,
            'mobile' : mobile.mobile,
            'passowrd' : password.password,
            'role' : role.role,
        }).then((result) => {
            console.log('resuklt', result);
            if(result.ok && result.data.status === 200 && result.data.message === "3"){
                window.location.replace('/');
            }else if(result.ok && result.data.status === 200 && result.data.message === "2"){
                window.location.replace('author');
            }else{
                window.location.replace('/register');
            }
        });

    }

    // useEffect(() => {
        
    //     handleInput
    //   },registrationSubmit);

    return(
        <Container className={classes.container} maxWidth="xs">
            <AppBar color="secondary">
                <Toolbar>
                    <Typography color="initial" variant='body1'>
                        BlogZilla
                    </Typography>
                </Toolbar>
            </AppBar>
            <Alert severity="error">This is an error alert — check it out!</Alert>
            <form onSubmit={registrationSubmit} method="POST">
            
                <Box mt={8}><h1>Register</h1></Box>
                <Grid container spacing={3}>
                    <Grid item xs={12}>
                        <Grid container spacing={2}>
                            <Grid item xs={12}>
                                <TextField fullWidth label="First Name" name="firstName" onChange={handleInput} value={firstName.firstName} size="small" variant="outlined"/>
                            </Grid>
                            <Grid item xs={12}>
                                <TextField
                                 fullWidth label="Last Name" onChange={handleInput} value={lastName.lastName} name="lastName" size="small" variant="outlined"
                                 />
                            </Grid>
                            <Grid item xs={12}>
                                <TextField
                                 fullWidth label="Middle Name" onChange={handleInput} value={middleName.middleName} name="middleName" size="small" variant="outlined"
                                 />
                            </Grid>
                            <Grid item xs={12}>
                                <TextField
                                 fullWidth label="Email" onChange={handleInput} value={email.email} name="email" type="email" size="small" variant="outlined"
                                 />
                            </Grid>
                            <Grid item xs={12}>
                                <TextField
                                 fullWidth label="Mobile" onChange={handleInput} value={mobile.mobile} name="mobile" type="number" size="small" variant="outlined"
                                 />
                            </Grid>
                            <Grid item xs={12}>
                                <TextField
                                 fullWidth label="Password" onChange={handleInput} value={password.password} name="password" type="password" size="small" variant="outlined"
                                 />
                            </Grid>
                            <Grid item xs={12}>
                            <InputLabel id="label">Role</InputLabel>
                            <NativeSelect selected={role} name="role" onChange={handleInput} value={role.role} fullWidth>
                            <option value="2">Author</option>
                            <option value="3">User</option>
                            </NativeSelect>
                            </Grid>
                        </Grid>
                    </Grid>
                    <Grid item xs={12}>
                        <Button color="secondary" fullWidth type="submit" variant="contained">
                            Register
                        </Button>
                        <Box display="flex" justifyContent="center" alignItems="center">
                            <Link color="inherit" href='/login'>
                               or LogIn
                            </Link>
                        </Box>
                    </Grid>
                </Grid>
            </form>
        </Container>
    );
};
// function Login() {
//     return <h2>Home</h2>;
//   }

export default RegistrationPage;

if (document.getElementById('register')) {
    ReactDOM.render(<RegistrationPage />, document.getElementById('register'));
  }