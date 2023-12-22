<div>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$totalimagenes}}</h3>
                    <p>Imagenes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-images"></i>
                </div>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$totalaudios}}</h3>

                <p>Audios</p>
              </div>
              <div class="icon">
              
                <i class="ion ion-music-note"></i> 
             
              </div>
             
            </div>
          </div>

          <!-- Documentos -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$totaldocumentos}}</h3>

                <p>Documentos</p>
              </div>
              <div class="icon">              
                <i class="ion ion-document-text"></i>               
              </div>
             
            </div>
          </div>

            <!-- Videos -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$totalvideos}}</h3>

                <p>Videos</p>
              </div>
              <div class="icon">              
                <i class="ion ion-videocamera"></i>               
              </div>
             
            </div>
          </div>

    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
            <h5>Almacenamiento en disco</h5>
            <div class="progress progress-micro mb-10">
                <div class="progress-bar bg-indigo-500" style="width: {{$diskuse}}">
                    <span class="sr-only">{{$diskuse}}</span>
                </div>
            </div>
            <span class="pull-right">{{round($disk_used_size,2)}} GB / {{round($total_disk_size,2)}} GB ({{$diskuse}})</span>
        </div>

        

    </div>
    <div class="row mt-4" >
      <table class="table table-striped">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Pagina</th>
                <th>Cantidad</th>                
            </tr>
        </thead>

        <tbody>
             @foreach ($visitas as $visita)
                <tr>
                   <td>{{$visita->fecha}}</td>
                    <td>{{$visita->pagina}}</td>
                    <td>{{$visita->num}}</td>                   
                </tr>
            @endforeach 
        </tbody>
    </table>

    <div >
      {{$visitas->links()}}
     </div>
    </div>
</div>
