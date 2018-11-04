<?php
function check_user_permission($request, $action_name = NULL,$id = NULL)
{

    if($action_name) {
        $current_action_name = $action_name;
    } else {
        $current_action_name = $request->route()->getActionName();
    }

    if($id) {
        $blog_id = $id;
    } else {
        $blog_id = $request->route("blog");
    }

    $current_user = $request->user();

    list($controller, $method) = explode('@', $current_action_name);
    $controller = str_replace(["App\\Http\\Controllers\\Backend\\", "Controller"],"",$controller);
    $controller = strtolower($controller);
    $crud_permissions_map = [
        'read' => ['index', 'show','view'],
        'create' => ['create'],
        'update' => ['edit', 'update','store'],
        'delete' => ['delete', 'destroy', 'restore','forceDelete']

    ];

    foreach($crud_permissions_map as $permission => $methods) {
        if(in_array($method, $methods)) {
            $permission = "{$permission}-{$controller}";
            if($controller === 'blog' && !empty($blog_id)) {
                $blog = \App\Post::withTrashed()->find($blog_id);

                if(!$current_user->hasPermission('update-others-blog') && $current_user->id != $blog->author_id) {
                    return false;
                }
            }
            if(!$current_user->hasPermission($permission)) {
                return false;
            }
        }
    }
    return true;
}

