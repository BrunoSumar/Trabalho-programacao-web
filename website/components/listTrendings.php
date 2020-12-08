<?php

$base_url = 'http://localhost/UFF/Trabalho-programacao-web1/';
$output = '';

if(isset($_GET['action'])){
    if($_GET['action'] == 'newBookmarks'){
        $api_url = $base_url."API/controllers/trendingController.php?action=newBookmarks";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);
        if (is_countable($result) && count($result) > 0) {
            foreach ($result as $row) {
                $output .= '';
            }
        }else {
            $output .= '
                <div class="container" style="text-align: center;">
                    <span style="text-align:center">
                        Nenhum bookmark adicionado recentemente.
                    </span>
                </div>
            ';
        }
    }else

}





function get_path($thumb_id)
{
    $api_url ="http://localhost/UFF/Trabalho-programacao-web1/API/controllers/thumbnailController.php?action=fetch_one_by_id&idThumb=$thumb_id";
    $client = curl_init($api_url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    $result = json_decode($response);
    return(isset($result[0]->path_img)? 'http://localhost/UFF/Trabalho-programacao-web1/API/'.$result[0]->path_img : 'img/preview.png');
}
// echo get_path(6);


        $output .= '
        <div class="card borderless conteudo text-light my-5">
          <div class="card-header gradient-azul">
            <!--<i class="far fa-bookmark"></i>-->
            '.($row->is_private ? '<i class="fas fa-lock"></i>' : '<i class="fas fa-lock-open"></i>').'
            <span class="titleModalBookmark"> '.$row->title.'</span>
            <div class="float-right">
                <button id="'.$row->bookmark_id.'" class="btn text-white-50 p-0 edit" type="button" data-toggle="modal" data-target="#bookmarkModal"><i class="far fa-edit"></i></button>
                <button id="'.$row->bookmark_id.'" class="btn text-white-50 p-0 delete" type="button" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-3">
                <img class="w-100" src="'.get_path($row->thumb_id).'">
              </div>
              <div class="col">
                <p class="card-text">'.$row->notes.'</p>
                <span class="text-light font-weight-bold">URL:</span>
                <a href="'.
                          ((substr($row->url, 0, 4) === 'http') ? $row->url:'http://'.$row->url)
                        .'" class="" target="_blank">'.$row->url.'
                    <button class="btn text-light" type="button" name="button" >
                      <i class="fas fa-external-link-alt"></i>
                    </button>
                </a>

              </div>
            </div>
            <h5>
              <span class="badge badge-light">tags...</span>
            </h5>
          </div>
        </div>';
    }
}
echo $output;
curl_close($client);


