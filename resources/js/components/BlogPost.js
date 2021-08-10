import React, { useState } from 'react';
import { TextField, Avatar, IconButton, Card, CardHeader, CardMedia, CardContent, CardActions, Collapse, Typography } from '@material-ui/core';
import { makeStyles } from '@material-ui/core/styles';
import { Comment as CommentIcon, ThumbUpAlt as ThumbUpAltIcon } from '@material-ui/icons';
import { blue } from '@material-ui/core/colors';
import clsx from 'clsx';

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

function BlogPost (props) {
    const classes = useStyles();
    const { blog } = props;
    const [expanded, setExpanded] = useState(false);

    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: '2-digit' };
    const today  = new Date();

    const handleExpandClick = () => {
        setExpanded(!expanded);
    };

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
                <IconButton aria-label="add to favorites">
                    <ThumbUpAltIcon />
                </IconButton>
                <IconButton 
                    className={clsx(classes.expand, {
                        [classes.expandOpen]: expanded,
                    })}
                    onClick={handleExpandClick}
                    aria-expanded={expanded}
                    aria-label="show more"
                >
                    <CommentIcon />
                </IconButton>
            </CardActions>
            <Collapse in={expanded} timeout="auto" unmountOnExit>
                <CardContent>
                <Typography paragraph>Comments:</Typography>
                {
                blog.comments.map((comment) =>(
                    
                    <Typography paragraph>
                        <Typography variant="p">
                            {comment.user_name}
                        </Typography>
                    
                    {comment.comment}
                    </Typography>
                    
                ))
                }
                <TextField
                    label="My Comment"
                    placeholder="Place Comment here!"
                    multiline
                    variant="filled"
                    fullWidth
                    name="comment"
                />
                
                </CardContent>
            </Collapse>
        </Card>
    )
}

export default BlogPost;