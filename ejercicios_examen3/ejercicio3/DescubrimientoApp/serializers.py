from rest_framework import serializers
from DescubrimientoApp.models import Descubrimiento, AreaConocimiento

class DescubrimientoSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = Descubrimiento
        fields = '__all__'

class AreaConocimientoSerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = AreaConocimiento
        fields = '__all__'