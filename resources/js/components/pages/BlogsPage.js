import React, { Fragment, useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import { CardMedia, AppBar, Collapse, Toolbar, Typography, FormLabel, Card, Box, Link, Button, Grid, Container, TextField, Paper, CardHeader, Avatar, CardContent, CardActions, IconButton} from '@material-ui/core';
// import { LikeIcon, CommentIcon} from '@material-ui/icons';
import ThumbUpAltIcon from '@material-ui/icons/ThumbUpAlt';
import CommentIcon from '@material-ui/icons/Comment';
import { makeStyles } from '@material-ui/core/styles';
import api from '../../config/api';
import { blue } from '@material-ui/core/colors';
import clsx from 'clsx';
import BlogPost from '../BlogPost';

const useStyles = makeStyles((theme) => ({
    container:{
        padding: theme.spacing(3),
    },
    root:{
        maxWidth: 500,
        // backgroundColor: blue,
    },
    logout: {
        marginLeft: 'auto',
      },
    avatar: {
        backgroundColor: blue[500],
    },
    image: {
        height: 0,
        paddingTop: '56.25%', // 16:9
      },
      expand: {
        transform: 'rotate(0deg)',
        transition: theme.transitions.create('transform', {
          duration: theme.transitions.duration.shortest,
        }),
      },
}));

function BlogsPage() {
    const classes = useStyles();
    const [blogs, setBlogs] = useState([]);

    const fetchBlogs = () => {
        api.get('/api/blogs').then((response) => {
            setBlogs(response.data.blogs)
        });
    }

    useEffect(() => {
        fetchBlogs()
    }, []);

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
                    </Box>
                </Toolbar>
            </AppBar>
            <Toolbar />
            {
                blogs !== null ? (
                    blogs.map((blog) => (
                        <BlogPost blog={blog} />
                    ))
                ) : null
            }
        </Container>
    );
};

export default BlogsPage;

if (document.getElementById('blogs')) {
    ReactDOM.render(<BlogsPage />, document.getElementById('blogs'));
  }