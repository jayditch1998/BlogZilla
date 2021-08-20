import React, { useEffect, useState } from 'react';
import { CardActionArea, Button, Link, Badge, Divider, Grid, Paper, Box, TextField, Avatar, IconButton, Card, CardHeader, CardMedia, CardContent, CardActions, Collapse, Typography } from '@material-ui/core';
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
    const classes = useStyles();
    const { blog } = props;
    const [expanded, setExpanded] = useState(false);
    const [ numberOfLikes, setNumberOfLikes ] = useState(0);
    const [ userLikedPost, setUserLikedPost ] = useState(false);
    const [ numberOfComments, setNumberOfComments ] = useState(0);
    const [comment, setComment] = useState("");
    const [comments, setComments] = useState([]);
    // const [, setComments] = useState([]);


    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: '2-digit' };
    const userID =  document.querySelector("meta[name='user-id']").getAttribute('content');
    const userName =  document.querySelector("meta[name='user-name']").getAttribute('content');


    const handleExpandClick = () => {
        setExpanded(!expanded);
    };

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
    

    const handleInput = (e) => {
        e.persist();
        setComment({...comment, [e.target.name]: e.target.value});
    }
    
    const submitComment = (e) => {
        e.preventDefault();
        
        console.log('Comment: ', comment);
        // blog.push(comment);
        api.get(`/comment/${blog.id}`, {    
            'comment' : comment.comment,
        }).then((result) => {
            console.log('resuklt', result);
            if(result.data.message === 'submitted'){
                setNumberOfComments((currentNumberComments) => currentNumberComments +1);
                // setComments((currentComments) => currentComments.push(comment));
            }
            document.getElementById('submitMyComment').defaultValue = '';
            setComment('');
           
        });
        // console.log(blog.comments)
    }

    // const viewDetails = () => {
    //     api.get(`api/view/${blog.id}`).then((response) => {
    //         // console.log(response.data.blog.comments);
    //         setBlog(response.data.blog)
    //     });
    // }

    const handleSubmitComment = () => {
        
        // onChange={handleInput} value={comment.comment}
    }

    useEffect(() => {
        // get blog and count number likes 
        // check also if the current user liked the post 
        let count = 0;
        let didUserLikeBlogs = false;
        // console.log(blog)
        blog.likes.map((data) => {
            if(parseInt(data.is_like) === 1){
                count++;
            }

            if(data.user_id == userID && parseInt(data.is_like) == 1){
                didUserLikeBlogs = true;
            }
        });
        let numberOfComments = blog.comments.length;
        let commentators = blog.comments;
        setNumberOfLikes(count)
        setUserLikedPost(didUserLikeBlogs)
        // save number of like in the "numberOfLikes" state
        // save true/false in the "userLikedPost" state 
        setNumberOfComments(numberOfComments)
        // console.log(comments)
        // setComments(comments)
        // let 
        setComments(commentators)
        console.log('commentators', commentators)

    }, [])
   
    return (
        <Card className={classes.root}>
            <CardActionArea href={`view/${blog.id}`}>
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
            </CardActionArea>
            <CardContent>
                <Typography variant="body2" color="textSecondary" component="p">
                {blog.body}
                </Typography>
            </CardContent>
            <CardActions disableSpacing>
                <IconButton onClick={onPressLikeButton} aria-label="like post">
                        <Badge color="secondary" badgeContent={numberOfLikes}>
                            <ThumbUpAltIcon
                                style={{color: userLikedPost ? 'red' : 'grey'}}
                            />
                        </Badge>
                </IconButton>
                <IconButton 
                    className={clsx(classes.expand, {
                        [classes.expandOpen]: expanded,
                    })}
                    onClick={handleExpandClick}
                    aria-expanded={expanded}
                    aria-label="show coemment"
                >
                    <Badge color="secondary" badgeContent={numberOfComments}>
                        <CommentIcon />
                    </Badge>
                </IconButton>
            </CardActions>
            <Collapse in={expanded} timeout="auto" unmountOnExit>
                <CardContent>
                <Typography paragraph>Comments:</Typography>
                {
                comments.map((comment) =>(
                    
                    <Typography>
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
                        required
                        id="submitMyComment"
                    />
                    <Button onClick={handleSubmitComment} fullWidth variant="contained" color="primary" type="submit">Submit Comment</Button>
                </form>
                </CardContent>
            </Collapse>
        </Card>
    )
}

export default BlogPost;