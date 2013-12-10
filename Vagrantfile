# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant::Config.run do |config|

  config.vm.define :loadbalancer do |srv|
    srv.vm.box = "loadbalancer"
    srv.vm.host_name = "LoadBalancer"
    srv.vm.box_url = "http://files.vagrantup.com/precise32.box"
    srv.vm.provision :shell, :path => "config/loadbalancer/install.sh"
    srv.vm.network :hostonly, "192.168.10.4"
  end

  config.vm.define :server1 do |srv|
    srv.vm.box = "server1"
    srv.vm.host_name = "Server1"
    srv.vm.box_url = "http://files.vagrantup.com/precise32.box"
    srv.vm.provision :shell, :path => "config/server1/install.sh"
    srv.vm.network :hostonly, "192.168.10.100"
  end

  config.vm.define :server2 do |srv|
    srv.vm.box = "server2"
    srv.vm.host_name = "Server2"
    srv.vm.box_url = "http://files.vagrantup.com/precise32.box"
    srv.vm.provision :shell, :path => "config/server2/install.sh"
    srv.vm.network :hostonly, "192.168.10.101"
  end

end
