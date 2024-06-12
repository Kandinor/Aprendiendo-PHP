from django.shortcuts import render
from django.views import generic
from .models import AreaConocimiento, Descubrimiento
from .serializers import DescubrimientoSerializer, AreaConocimientoSerializer
from rest_framework import viewsets


class ListadoArea(generic.ListView):
    model = AreaConocimiento
    template_name = "DescubrimientoApp/Listado.html"
    context_object_name = "areas"

    
    
class DetalleDescubrimiento(generic.ListView):
    model = Descubrimiento
    template_name = "DescubrimientoApp/Detalle.html"
    context_object_name = "area"
    paginate_by = 2

    def get_queryset(self):
        return Descubrimiento.objects.all().order_by('nombre')
    
class DescubrimientoViewSet(viewsets.ModelViewSet):
    queryset = Descubrimiento.objects.all()
    serializer_class = DescubrimientoSerializer

    def get_queryset(self):
        return Descubrimiento.objects.all().order_by('fecha_creacion')
    
class AreaConocimientoViewSet(viewsets.ModelViewSet):
    queryset = AreaConocimiento.objects.all()
    serializer_class = AreaConocimientoSerializer