#1>.
/**
* How to use cache_set() and cache_get() function 
*/

cache_set($cid, $data, $bin = 'cache')
cache_get($cid, $bin = 'cache')
cache_clear_all('*', $bin = NULL, $wildcard = FALSE)

custom cache setter and getter function:

cache_setter_getter($cid, $data)

#2>.
/**
* How to embed views 
*/

views_embed_view('VIEWS_MACHINE_NAME', 'DISPLAY_ID', $view_arg);

1>. VIEWS_MACHINE_NAME: The machine name of the view you wanted to render.
2>.DISPLAY_ID: The display you want to render of that view.
3. $view_arg: Argument value your view accepts. e.g. I've a view which display nodes created by current logged in user, so this will be $user->uid

- example

http://mysite.test.com/admin/structure/views/view/my_test_view/edit/block_2

$my_arg = 1;
print views_embed_view('my_test_view', 'block_2', $my_arg);


#3>.

/**
* Embed view with pagination with caching
*/

        $page_cnt = isset($_GET['page']) ? $_GET['page'] : 0;
	$view_arg = null;
	$cid = 'article_page_list_data_' . $page_cnt;
	$data = views_embed_view('article_page_list', 'block', $view_arg);

	echo cache_setter_getter($cid, $data);