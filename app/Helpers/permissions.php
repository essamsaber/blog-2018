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

    $required_permission = "{$method}-{$controller}";
    $roles = $current_user->roles;
    $user_permissions=[];
    foreach($roles as $role) {
        $permissions = $role->permissions()->pluck('name');
        foreach($permissions as $permission) {
            if(!in_array($permission, $user_permissions)) {
                $user_permissions[] = $permission;
            }
        }
    }
    if(in_array($required_permission, $user_permissions)) {

        if($controller === 'blog' && !empty($blog_id)) {
            $blog = \App\Post::withTrashed()->find($blog_id);

            if(!$current_user->hasPermission($required_permission) && $current_user->id != $blog->author_id) {
                return false;
            }
            if($current_user->id == $blog->author_id) {
                return true;
            }
        }
        if(!$current_user->hasPermission($required_permission)) {

            return false;
        }
    }
    return true;
}

