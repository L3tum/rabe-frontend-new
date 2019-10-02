$image = "docker.netrtl.com/phing:latest"
$pwd = $PSScriptRoot.Replace("\", "/")
$linux_pwd = "/host_mnt/" + $pwd.Replace(":", "").ToLower()

docker pull $image
docker run --rm --volume /var/run/docker.sock:/var/run/docker.sock --volume ${pwd}:${linux_pwd} -w ${linux_pwd} --env-file ${pwd}/build.env $image phing $args
