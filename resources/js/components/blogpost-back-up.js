import React, { useEffect, useState } from 'react';
import { Button, Link, Badge, Divider, Grid, Paper, Box, TextField, Avatar, IconButton, Card, CardHeader, CardMedia, CardContent, CardActions, Collapse, Typography } from '@material-ui/core';
import { makeStyles } from '@material-ui/core/styles';
import { Comment as CommentIcon, ThumbUpAlt as ThumbUpAltIcon } from '@material-ui/icons';
import ThumbUpAltOutlinedIcon from '@material-ui/icons/ThumbUpAltOutlined';
import { blue } from '@material-ui/core/colors';
import clsx from 'clsx';
import api from '../config/api';
import { truncate } from 'lodash';

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

function BlogPost (props) {
    const userID =  document.querySelector("meta[name='user-id']").getAttribute('content');
    const userName =  document.querySelector("meta[name='user-name']").getAttribute('content');
    const classes = useStyles();
    const { blog } = props;
    const [expanded, setExpanded] = useState(false);
    const [ isLiked, setIsLiked] = useState(false);
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: '2-digit' };
    const today  = new Date();

    const [ numberOfLikes, setNumberOfLikes ] = useState(0);
    const [ userLikedPost, setUserLikedPost ] = useState(false);


    const handleExpandClick = () => {
        setExpanded(!expanded);
    };

    function countLikes () {
        let count = 0;
        blog.likes.map((data) => {
            if(parseInt(data.is_like) === 1){
                count++;
            }
        })
        return count;
        
    }

    const onPressLikeButton = () =>{
        api.get(`/like/${blog.id}`).then((result) => {
            console.log('liked result', result);

            if (result.data.message === 'unliked') {
                setNumberOfLikes((currentLikes) => currentLikes - 1);
                if (userLikedPost) {
                    setUserLikedPost(false);
                }
            } else if (result.data.message === 'liked') {
                setNumberOfLikes((currentLikes) => currentLikes + 1);
                setUserLikedPost(true);
            }

        });
    }

    const userLiked = () => {
        let like = blog.likes.find(data => {
            if(data.user_id == userID && parseInt(data.is_like) == 1){
                return true;
            }else{
                return false;
            }
        })
        // blog.likes.map((data) => {
        //     if(data.user_id == userID && parseInt(data.is_like) == 1){
        //         console.log(data.user_id);
        //         console.log(userID);
        //         // setIsLiked(true);
        //         // return true;
        //         like = true;
        //         return true;
        //     }else{
        //         // setIsLiked(false)
        //         // return false;
        //         // console.log('false');
        //         like = false;
        //         console.log(data.user_id);
        //         console.log(userID);
        //     }
        // })
        // return false;
        return like;
    }
    // const check = blog.
    // console.log(blog.likes.user_id);
    // const countLikes = (params) => {
    //     return 0;
    // }
    // useEffect(() => {
    //     liked();
    // },[]);

    const [comment, setComment] = useState("");

    const handleInput = (e) => {
        e.persist();
        setComment({...comment, [e.target.name]: e.target.value});
    }
    
    const submitComment = (e) => {
        e.preventDefault();
        console.log('test submit', comment);


        api.post('/post/register', {
            'comment' : comment.comment,
        }).then((result) => {
            console.log('resuklt', result);
        });
    }
    // let like = blog.likes.find(data => {
    //     if(data.user_id == userID && parseInt(data.is_like) == 1){
    //         setUserLikedPost(true)
    //     }else{
    //         setUserLikedPost(false)
    //     }
    // })
    useEffect(() => {
        // get blog and count number likes 
        // check also if the current user liked the post 
        let count = 0;
        let didUserLikeBlogs = false;
        blog.likes.map((data) => {
            if(parseInt(data.is_like) === 1){
                count++;
            }

            if(data.user_id == userID && parseInt(data.is_like) == 1){
                didUserLikeBlogs = true;
            }
        });

        setNumberOfLikes(count)
        setUserLikedPost(didUserLikeBlogs)
        // save number of like in the "numberOfLikes" state
        // save true/false in the "userLikedPost" state 

    }, [])
   
    return (
        <Card className={classes.root}>
            <CardHeader
                avatar={
                    <Avatar aria-label="author" title={blog.author} className={classes.avatar}>
                        {(blog.author).charAt(0)}
                    </Avatar>
                }
                title={blog.title}
                // titleTypographyProps={blog.title === 'Good Dog' ? {
                //     variant: 'h2',
                //     style: {
                //         color: 'red'
                //     }
                // } : {
                //     variant: 'h6'
                // }}
                subheader={new Date(blog.created_at).toLocaleDateString("en-US", options)}
            />
            {
                blog.img ? (
                    <CardMedia
                        className={classes.image}
                        image={blog.img}
                        title={blog.author}
                    />
                ) : (
                    <Typography variant='body1'></Typography>
                )
            }
            <CardContent>
                <Typography variant="body2" color="textSecondary" component="p">
                {blog.body}
                </Typography>
            </CardContent>
            <CardActions disableSpacing>
                <IconButton onClick={onPressLikeButton} aria-label="add to favorites">
                        <Badge color="secondary" badgeContent={numberOfLikes}>
                            {/* {
                                console.log(liked())
                            } */}
                            <ThumbUpAltIcon
                                style={{color: userLikedPost ? 'red' : 'grey'}}
                            />
                        </Badge>
                        {/* <Badge color="secondary" badgeContent={1} showZero>
                            <ThumbUpAltOutlinedIcon />
                        </Badge> */}
                </IconButton>
                <IconButton 
                    className={clsx(classes.expand, {
                        [classes.expandOpen]: expanded,
                    })}
                    onClick={handleExpandClick}
                    aria-expanded={expanded}
                    aria-label="show coemment"
                >
                    <Badge color="secondary" badgeContent={blog.comments.length}>
                        <CommentIcon />
                    </Badge>
                </IconButton>
            </CardActions>
            <Collapse in={expanded} timeout="auto" unmountOnExit>
                <CardContent>
                <Typography paragraph>Comments:</Typography>
                {
                blog.comments.map((comment) =>(
                    
                    <Typography>
                        {/* <Box fontWeight="fontWeightBold" className={classes.commentor} variant="p">
                            {comment.user_name}
                        </Box> */}
                    
                    <Paper style={{ padding: "10px 20px" }}>
                        <Grid container wrap="nowrap" spacing={2}>
                        <Grid item>
                            <Avatar aria-label="author" title={blog.author} className={classes.avatar}>
                            {(comment.user_name).charAt(0)}
                            </Avatar>
                        </Grid>
                        <Grid justifyContent="left" item xs zeroMinWidth>
                            <p className={classes.commentor}>{comment.user_name}</p>
                            <p className={classes.comments}>
                            "{comment.comment}"{" "}
                            </p>
                            <p className={classes.comment_time}>
                            {new Date(comment.created_at).toLocaleDateString("en-US", options)}
                            </p>
                        </Grid>
                        </Grid>
                        <Divider variant="fullWidth" style={{ margin: "10px 0" }} />
                    </Paper>
                    </Typography>
                    
                ))
                }
                <form onSubmit={submitComment} method="POST">
                    <TextField
                        label="My Comment"
                        placeholder="Place Comment here!"
                        multiline
                        variant="filled"
                        fullWidth
                        name="comment"
                        onChange={handleInput} value={comment.comment}
                    />
                    <Button fullWidth variant="contained" color="primary" type="submit">Comment</Button>
                </form>
                
                </CardContent>
            </Collapse>
        </Card>
    )
}

export default BlogPost;