import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import { AppBar,Toolbar, Typography, FormLabel, Box, Link, Button, Grid, Container, TextField } from '@material-ui/core';
import { makeStyles } from '@material-ui/core/styles';
import api from '../../config/api';
import { Component } from 'react';

const useStyles = makeStyles((theme) => ({
    container:{
        padding: theme.spacing(3),
    },
    logout: {
        marginLeft: 'auto',
      },
}));
    function BlogsPage(){
    const classes = useStyles();

    // const [blogs, setData] = useState({
    //     posts: ''
    // });

    
        api.get('/').then(response=>response.data[0].commit.message).then(console.log)
    
    
    // useEffect(() => {
    //     fetchData();
    // }, [])

    console.log(state.users.data)
    return(
        <Container className={classes.container} maxWidth="xs">
            <AppBar color="secondary">
                <Toolbar>
                    <Typography color="initial" variant='body1'>
                        BlogZilla
                    </Typography>
                    <Box className={classes.logout}>
                        <Button href="/logout" color="inherit">
                        LogOut
                        </Button>
                        {/* <Button color="inherit">
                        LogOut
                        </Button> */}
                    </Box>
                </Toolbar>
            </AppBar>
        </Container>
    );
};

export default BlogsPage;

if (document.getElementById('blogs')) {
    ReactDOM.render(<BlogsPage />, document.getElementById('blogs'));
  }