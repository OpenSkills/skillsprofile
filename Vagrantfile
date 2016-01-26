$HOSTNAME = "skillsprofile.dev"
$BOX = "ubuntu/trusty64"
$IP = "10.0.0.89"
$MEMORY = ENV.has_key?('VM_MEMORY') ? ENV['VM_MEMORY'] : "1024"
$CPUS = ENV.has_key?('VM_CPUS') ? ENV['VM_CPUS'] : "1"
$EXEC_CAP = ENV.has_key?('VM_EXEC_CAP') ? ENV['VM_EXEC_CAP'] : "100"

Vagrant.configure("2") do |config|
  config.vm.hostname = $HOSTNAME
  config.vm.box = $BOX
  config.vm.network :private_network, ip: $IP
  config.ssh.forward_agent = true

  config.vm.synced_folder ".", "/var/www/skillsprofile/current", type: "nfs"

  config.vm.provider "virtualbox" do |v|
    v.name = "skillsprofile"
    v.customize ["modifyvm", :id, "--cpuexecutioncap", $EXEC_CAP]
    v.customize ["modifyvm", :id, "--memory", $MEMORY]
    v.customize ["modifyvm", :id, "--cpus", $CPUS]
  end
end