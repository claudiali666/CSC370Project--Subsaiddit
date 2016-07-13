/* get all posts from account A sorting by (upvote- downvote) */
select post_id, post_title, post_URL, up_vote, down_vote, post_published, post_edited,
(posts.up_vote-posts.down_vote) As cal
From Posts posts
join User user on posts.post_user = user.user_id
where user.user_name = 'John'
order by cal DESC;

/* user one is friend with user 3, user 3 has posts 4 */
select post_id, post_title, post_URL, up_vote, down_vote, post_published, post_edited
(posts.up_vote-posts.down_vote) As cal
From Posts posts
join User user on posts.post_user = user.user_id
join Friends friend on Posts.post_user = friend.user_Friend
ORDER BY cal DESC;


/*get account John subscribed subsaiditts */
select subsaiddits_id, subsaiddits_is_default, subsaiddits_created_time, subsaiddits_description, subsaiddits_title
from Subsaiddits subsaid
join subscribe sub on subsaid.subsaiddits_id = sub.subsaid_id
join User user on subsaid.subsaiddits_user_id = user.user_id
where user_name = 'John';

/*get account favourite posts */
select post_id, post_title, post_URL, up_vote, down_vote, post_published, post_edited
from Posts posts
join favourite fav on fav.fav_user_ID = posts.post_user
join User user on user.user_id = posts.post_user
where user.user_name = 'Zheng';

/* get account frind favourtie posts 
   join three tables */
select post_id, post_title, post_URL, up_vote, down_vote, post_published, post_edited
from Posts posts
join User user on Posts.post_user = user.user_id
join Friends friend on friend.user_Friend = posts.post_user
join favourite fav on fav.fav_post_ID = posts.post_id
where user_name = 'John';

/* get account friend subscribe subsaiddits */
select subsaiddits_id, subsaiddits_is_default, subsaiddits_created_time, subsaiddits_description, subsaiddits_title
from Subsaiddits subsaid
join subscribe sub on subsaid.subsaiddits_id = sub.subscribe_subsaid_id
join User user on user.user_id = sub.subscribe_user_id
join Friends friend on friend.user_ID = sub.subscribe_user_id
where user.user_name !='John';


/* get all subsaiddits creator's posts */
select post_id, post_title, post_URL, up_vote, down_vote, post_published, post_edited
from Subsaiddits subsaid
join User user on user.user_id = subsaid.subsaiddits_user_id
inner join Posts posts on posts.post_user = subsaid.subsaiddits_user_id
group by post_id;



/* get all the post in subsaiddit 1 with a post has text google */
select post_id, post_title, post_URL, up_vote, down_vote, post_published, post_edited
from Subsaiddits subsaid
join Posts posts on posts.post_subsaiddits = subsaid.subsaiddits_id
where posts.post_URL like '%google%'AND subsaid.subsaiddits_id = 1;













 
