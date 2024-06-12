from django.urls import path
from .views import ListadoArea

urlpatterns = [
    path('', ListadoArea.as_view(), name='obra-list'),
]