import { CircularProgress, AppBar, Paper, Button, Container, Grid, Toolbar, Typography, Box, Avatar } from '@material-ui/core';
import { Add as AddIcon } from '@material-ui/icons';
import React, { useState } from 'react';
import ReactDOM from 'react-dom';

const MyFirstReactPage = ()=>{
    const [ctr, setCounter] = useState(0);
    const [loading, setLoading] = useState(false);
    const [person, setPerson] = useState(null);

    const fetchPerson = () => fetch('https://randomuser.me/api/').then((data) => data.json());

    const onGetRandomPerson = async () => {
        if (!loading) {
            setLoading(true);
            const data = await fetchPerson();
            console.log('data', data);
            setPerson(data.results);
            setLoading(false);
        }
    }
    
    const onClickCounter = () => {
        setCounter(ctr + 1);
    }

    return(
        <Container>
            <AppBar>
                <Toolbar>
                    <Typography variant='body1'>
                        My First React Page
                    </Typography>
                </Toolbar>
            </AppBar>
            <Toolbar />
            <Grid container>
                <Grid item xs={6}>
                    <Button startIcon={<AddIcon/>} onClick={onClickCounter}>
                        Add
                    </Button>
                    <Button startIcon={<AddIcon/>} onClick={onGetRandomPerson}>
                        Get Random Person
                    </Button>

                </Grid>
                <Grid item xs={6}>
                    <Paper variant='outlined'>
                        <Typography variant='h6'>
                            {`Counter count : ${ctr}`}
                        </Typography>
                        {
                            loading ? (
                                <CircularProgress />
                            ) : person ? (
                                <Box>
                                    <Avatar src={person.picture.large} />
                                    <Typography variant='body1'>
                                        {`${person.name.first} ${person.name.last}`}
                                    </Typography>
                                    <Typography variant='caption'>
                                        {`${person.email}`}
                                    </Typography>
                                </Box>
                            ) : (
                                <Typography>No User</Typography>
                            )
                        }
                    </Paper>
                </Grid>
            </Grid>
        </Container>
    )
}

export default MyFirstReactPage;

if (document.getElementById('app')) {
  ReactDOM.render(<MyFirstReactPage />, document.getElementById('app'));
}