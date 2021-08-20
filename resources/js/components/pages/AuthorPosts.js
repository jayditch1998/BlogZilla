import React, { Fragment, useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import { CardMedia, AppBar, Collapse, Toolbar, Typography, FormLabel, Card, Box, Link, Button, Grid, Container, TextField, Paper, CardHeader, Avatar, CardContent, CardActions, IconButton} from '@material-ui/core';
// import { LikeIcon, CommentIcon} from '@material-ui/icons';
import ThumbUpAltIcon from '@material-ui/icons/ThumbUpAlt';
import PersonIcon from '@material-ui/icons/Person';
import { makeStyles } from '@material-ui/core/styles';
import api from '../../config/api';
import { blue } from '@material-ui/core/colors';
import { DataGrid } from '@material-ui/data-grid';
import clsx from 'clsx';
import BlogPost from '../BlogPost';
import VisibilityIcon from '@material-ui/icons/Visibility';
import EditIcon from '@material-ui/icons/Edit';
import DeleteIcon from '@material-ui/icons/Delete';
import AddIcon from '@material-ui/icons/Add';
import { CenterFocusStrong } from '@material-ui/icons';
// import ViewBlogPost from '../ViewBlogPage';

const useStyles = makeStyles((theme) => ({
    container:{
        padding: theme.spacing(2),
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
      commentor: {
        fontSize: 17,
        margin: 0,
        textAlign: 'left',
        textTransform: 'uppercase'
    },
    comments: {
        fontStyle: 'italic',
        fontSize: 15,
        textAlign: 'left',
    },
    comment_time:{
        textAlign: "left",
        color: "gray",
        fontSize: 10,
    },
}));


function AuthorPosts() {
    
    const classes = useStyles();
    const userName =  document.querySelector("meta[name='user-name']").getAttribute('content');
    const [blogs, setBlogs] = useState([]);
    const [ numberOfLikes, setNumberOfLikes ] = useState(0);
    const [ userLikedPost, setUserLikedPost ] = useState(false);
    const [ numberOfComments, setNumberOfComments ] = useState(0);
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: '2-digit' };

    const fetchBlogs = () => {
        api.get('/author/getPosts').then((response) => {
            setBlogs(response.data.blogs)
        });
    }
    // console.log(fetchBlogs())
    console.log(blogs)
    useEffect(() => {
        fetchBlogs()
        let count = 0;
        blogs.map((data) => {
            if(parseInt(data.is_like) === 1){
                count++;
            }
        });
        // let numberOfComments = blogs.comments.length;
        // console.log(blog.id)
        setNumberOfLikes(count)
        // setNumberOfComments(numberOfComments)
    }, []);
    const columns = [
        { field: 'id', headerName: '#', width: 85 },
        {
          field: 'author',
          headerName: 'Author Name',
          width: 200,
          editable: false,
        },
        {
            field: 'title',
            headerName: 'Title',
            width: 300,
            editable: false,
          },
        {
          field: 'date',
          headerName: 'Date Posted',
          width: 225,
          editable: false,
          renderCell: (params) => {
            return (
                new Date(params.row.created_at).toLocaleDateString("en-US", options)
            );
         }
        },
        {
          field: 'numLikes',
          headerName: 'Like/s',
          width: 120,
          editable: false,
          textAlign: 'center',
          valueGetter: (params) =>
        `${numberOfLikes}`,
        },
        {
        field: 'numcomments',
          headerName: 'Comment/s',
          width: 150,
          editable: false,
          valueGetter: (params) =>
        `1`,
        },
        {
        field: 'actions',
            headerName: 'Action',
            width: 160,
            renderCell: (params) => {
                return (
                <Box>
                    <IconButton href={`/author/view-post/${params.row.id}`}>
                        <VisibilityIcon  index={params.row.id} />
                    </IconButton>
                    <IconButton href={`/author/edit-post/${params.row.id}`}>
                        <EditIcon index={params.row.id} />
                    </IconButton>
                    <IconButton href={`/author/post/delete/${params.row.id}`}>
                        <DeleteIcon index={params.row.id} />
                    </IconButton>
                </Box>
                );
             }
        },
      ];

    return(
        <Container className={classes.container}maxWidth="lg" >
            <AppBar color="secondary">
                <Toolbar>
                    <Typography color="initial" variant='body1'>
                            BlogZilla
                    </Typography>
                    <Button color="inherit" href="/author" style={{ marginLeft: "20px" }}>
                        Dashboard
                    </Button>
                    <Button color="inherit" href="/author/posts">
                         Posts
                    </Button>
                    <Box className={classes.logout}>
                        <Button color="inherit">
                            <PersonIcon></PersonIcon>{userName}
                        </Button>
                        <Button href="/logout" color="inherit">
                        LogOut
                        </Button>
                    </Box>
                </Toolbar>
            </AppBar>
            {
                // console.log(numberOfLikes)
            }
            <Toolbar />
            {
                // console.log(blogs.likes)
            }
            <IconButton href="/author/add/post">
                <AddIcon />Upload
            </IconButton>
            <div style={{ height: 300, width: '100%', textAlign: "center" }}>
            <DataGrid
                rows={blogs}
                columns={columns}
                pageSize={5}
                // checkboxSelection
                disableSelectionOnClick
                
            />
            </div>
        </Container>
    );
};

export default AuthorPosts;

if (document.getElementById('authorManagePosts')) {
    ReactDOM.render(<AuthorPosts />, document.getElementById('authorManagePosts'));
  }