from django.db import models

# Create your models here.

class AreaConocimiento (models.Model):
    nombre = models.CharField(max_length=100)

    def __str__(self):
        return f'{self.nombre}'

class Descubrimiento (models.Model):
    nombre = models.CharField(max_length=100)
    descripcion = models.TextField()
    fecha_creacion = models.DateField()
    confirmado = models.BooleanField(default=True)
    areaConocimiento = models.ForeignKey(AreaConocimiento,on_delete=models.CASCADE, related_name='areaConocimiento')
        
    def __str__(self):
        return f'{self.nombre} {self.descripcion} {self.fecha_creacion} {self.confirmado} {self.areaConocimiento}'