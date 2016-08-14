#!/bin/bash

source .env

owner=$1
repo=$2

echo "Owner: $owner"
echo "Repo: $repo"

if [[ -z "$owner" || -z "$repo" ]]; then
    echo "Owner or repo not set";
    exit 1
fi

url_radic_repos="https://git.radic.nl/rest/api/1.0/projects/${owner}/repos"
url_radic_repo="https://git.radic.nl/rest/api/1.0/projects/${owner}/repos/${repo}"

url_github_org_repos="https://api.github.com/orgs/${owner}/repos"
url_github_org_repo="https://api.github.com/repos/${owner}/${repo}"

mirror_webhook_key="com.englishtown.stash-hook-mirror:mirror-repository-hook"
url_radic_webhooks="https://git.radic.nl/rest/api/1.0/projects/${owner}/repos/${repo}/settings/hooks"
url_radic_webhook="${url_radic_webhooks}/${mirror_webhook_key}"
url_radic_webhook_enabled="${url_radic_webhook}/enabled"
url_radic_webhook_settings="${url_radic_webhook}/settings"


_curl(){
    local to=$1
    local method=$2
    local url=$3
    shift
    shift
    shift
    local data=$*

    local cmd="curl"

    cmd="${cmd} --progress-bar"

    cmd="${cmd} --header \"Content-Type: application/json\""

    if [[ "$to" == "radic" ]]; then
        cmd="${cmd} --user \"${RADICGIT_USERNAME}:${RADICGIT_PASSWORD}\""
    elif [[ "$to" == "github" ]]; then
        cmd="${cmd} --user \"${GITHUB_USERNAME}:${GITHUB_TOKEN}\""
    else
        echo "Error: wrong to: ${to}"
        exit 1
    fi

    cmd="${cmd} --request ${method} ${url}"

    if [[ ! -z "$data" ]]; then
        cmd="${cmd} --data '${data}'"
    fi

    response=$(eval $cmd)

    echo -e "\n--------: CURL REQUEST INFO :--------\nto: $to \nmethod: $method \nurl: $url \ndata: $data \ncommand: $cmd \nresponse: $response \n--------:--------------:--------"

}

_radic_create_repo(){
    curl \
    --user "${RADICGIT_USERNAME}:${RADICGIT_PASSWORD}" \
    --header "Content-Type: application/json" \
    --request POST "${url_radic_repos}" \
    --data '{"name": "'"$repo"'"}'
}

_radic_delete_repo() {
    curl --user "${RADICGIT_USERNAME}:${RADICGIT_PASSWORD}" \
    -H "Content-Type: application/json" \
    -X DELETE "{$url_radic_repo}"
}

#_radic_response(){
#    node -e "var data="$radicGitJson"; console.log('rdasic', data);"
#}


_github_create_repo(){
    curl \
    --user "${GITHUB_USERNAME}:${GITHUB_TOKEN}" \
    --header "Content-Type: application/json" \
    --request POST "${url_github_org_repos}" \
    --data '{"name": "'"$repo"'", "has_wiki": false}'
}

_github_delete_repo(){
    curl \
    --user "${GITHUB_USERNAME}:${GITHUB_TOKEN}" \
    --header "Content-Type: application/json" \
    --request DELETE "${url_github_org_repo}"
}

_make_json(){
    php -r "echo json_encode($1, JSON_UNESCAPED_SLASHES);"
}

_radic_create_mirror(){
    # "encrypted:nPDB/YEeKacn1Fxf5VGDLA=="
    # encrypt will be done by hook plugin
    json=$(_make_json "[
        'mirrorRepoUrl0' => 'https://github.com/$owner/$repo',
        'password0' => '$GITHUB_PASSWORD',
        'username0' => '$GITHUB_USERNAME',
    ]")

    _curl "radic" "PUT" "$url_radic_webhook_settings" "$json"
    _curl "radic" "PUT" "$url_radic_webhook_enabled"
}



rcr=$(_radic_create_repo)
#rdr=$(_radic_delete_repo)
gcr=$(_github_create_repo)
#gdr=$(_github_delete_repo)
rcm=$(_radic_create_mirror)


#rcr=$(_radic_create_repo)
#echo "Repository created on radic.nl"
#
#gcr=$(_github_create_repo)
#echo "Repository created on github.com"

echo "$rcm"

exit;